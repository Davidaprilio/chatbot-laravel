import ContextMenu from '@/Components/ContextMenu';
import { AlertDialog, AlertDialogBody, AlertDialogContent, AlertDialogFooter, AlertDialogHeader, AlertDialogOverlay, Button, MenuItem, Spinner, useDisclosure, useToast } from '@chakra-ui/react';
import { Head } from '@inertiajs/react';
import { useCallback, useEffect, useMemo, useRef, useState } from 'react';
import ReactFlow, {
    addEdge,
    MiniMap,
    Controls,
    Background,
    useReactFlow,
    useNodesState,
    useEdgesState,
    Panel,
    ReactFlowProvider,
    applyEdgeChanges,
} from "reactflow";
import "reactflow/dist/style.css";
import "../../css/graphmessage.css";
import MessageNode from '@/Components/Nodes/MessageNode';
import ButtonEdge from '@/Components/Edges/ButtonEdge';
import { useHotkeys } from "react-hotkeys-hook";
import axios from 'axios';
import useDialog, { AlertDialogProvider } from '@/Components/AlertDialogProvider';
import ErrorClient from '@/Commons/ErrorClient';

function Flow({ flowChat, edges: edgesProp, nodes: nodesProp }) {
    const [nodes, setNodes] = useNodesState([]);
    const [edges, setEdges] = useEdgesState([]);
    const [clipboard, setClipboard] = useState(null)
    const [selectedNode, setSelectedNode] = useState(null)
    const [ctxMenuPosition, setCtxMenuPosition] = useState(null)
    const [showOverlayLoad, setShowOverlayLoad] = useState(false)
    const reactFlowInstance = useReactFlow();
    const toast = useToast();
    const dialog = useDialog()

    const flowKey = 'example-flow';
    const nodeTypes = useMemo(() => ({ messageNode: MessageNode }), []);
    const edgeTypes = useMemo(() => ({ buttonEdge: ButtonEdge }), []);

    const onEdgeConnect = useCallback(async (connection) => {
        try {
            const response = await axios.post('/graph/action-reply', {
                ...connection
            })
            setEdges((eds) => addEdge(response.data, eds))
        } catch (error) {

        }
    }, [setEdges]);

    const addMessageNode = useCallback(async () => {
        try {
            const response = await axios.post(`/graph/${flowChat.id}/message`, {
                text: '',
            })
            const message = response.data
            setNodes((nds) => nds.concat(message));
            console.log('created');
        } catch (error) {
            alert('Error Create Message')
            console.error(error);
        }
    }, [setNodes, nodes.length]);


    const handleOnEdgesChange = useCallback(async (changesEdge) => {
        // get type of change
        const type = changesEdge[0].type;
        try {
            if (type === 'remove') await onDeleteEdges(changesEdge)
        } catch (error) {
            if (error instanceof ErrorClient) return;
            return console.error(error);
        }

        setEdges((eds) => applyEdgeChanges(changesEdge, eds))
    }, []);

    const handleOnNodeChange = useCallback(async (changesNode) => {
        // get type of change
        const type = changesNode[0].type;
        try {
            if (type === 'remove') await onDeleteNode(changesNode)
        } catch (error) {
            if (error instanceof ErrorClient) return;
            return console.error(error);
        }

        setNodes((nds) => applyEdgeChanges(changesNode, nds))
    }, []);

    const onDeleteEdges = useCallback(async (edges) => {
        setShowOverlayLoad(true)
        try {
            await axios.delete(`graph/${flowChat.id}/action-reply`, {
                data: {
                    edges
                }
            })
            console.log('onEdgesDelete', edges, 'Deleted');
        } catch (error) {
            toast({
                title: 'Opps, Failed Delete Action Reply',
                description: `Your Action Reply has not been deleted.`,
                status: 'error',
                duration: 7000,
                isClosable: true,
            })
            setShowOverlayLoad(false)
            throw error;
        }
        setShowOverlayLoad(false)
        toast({
            title: 'Action Reply Deleted',
            description: `${edges.length} Action Reply has been deleted.`,
            status: 'success',
            duration: 3000,
            isClosable: true,
        })
    }, [flowChat.id]);

    const onDeleteNode = useCallback(async (nodes, force = false) => {
        if (force === false) {
            const confirmDelete = await dialog.confirm({
                title: 'Confirm Delete Message',
                message: `Are you sure you want to delete ${nodes.length > 1 ? 'messages' : 'this message'}?`,
                okText: 'Yes, Delete',
            })
            if (confirmDelete === false) throw new ErrorClient('Delete Cancelled')
        }

        setShowOverlayLoad(true)
        try {
            await axios.delete(`graph/${flowChat.id}/message`, {
                data: {
                    nodes,
                    force,                    
                }
            })
            console.log('onNodeDelete', nodes, 'Deleted');
        } catch (error) {
            // if error status 400
            if (error.response.status === 400 && force === false) {
                const isConfirmed = await dialog.confirm({
                    title: 'Force Delete Message?',
                    message: error.response.data.message,
                    okText: 'Yes, Force Delete',
                    cancelText: 'No, Cancel',
                })
                console.log('Force Delete Cancelled', isConfirmed);
                if (isConfirmed) {
                    return await onDeleteNode(nodes, true);
                }
                setShowOverlayLoad(false)
                throw new ErrorClient('Force Delete Cancelled')
            }
            toast({
                title: `Opps, Failed ${force && 'Force '}Delete Message`,
                description: force ? 'maybe you can delete the relationship manually first' : 'Your Message has not been deleted.',
                status: 'error',
                duration: 7000,
                isClosable: true,
            })
            setShowOverlayLoad(false)
            throw error;
        }
        setShowOverlayLoad(false)
        toast({
            title: 'Message Deleted',
            description: `${nodes.length} Message has been deleted.`,
            status: 'success',
            duration: 3000,
            isClosable: true,
        })
    }, [flowChat.id]);

    const onSaveViewport = useCallback(() => {
        console.log('Save Viewport');
        const flow = reactFlowInstance.toObject();
        localStorage.setItem(flowKey, JSON.stringify(flow));
        axios.post('graph/flowchat/' + flowChat.id, {
            viewport_x: flow.viewport.x,
            viewport_y: flow.viewport.y,
            viewport_zoom: flow.viewport.zoom,
        })
    }, []);

    const restoreFlow = async () => {
        const { x = 334, y = 400, zoom = 1 } = {
            x: flowChat.viewport_x,
            y: flowChat.viewport_y,
            zoom: flowChat.viewport_zoom,
        };
        setNodes(nodesProp || []);
        setEdges(edgesProp || []);
        reactFlowInstance.setViewport({ x, y, zoom })
    };

    const selectAllNode = useCallback(() => {
        setNodes((nds) => nds.map((node) => {
            node.selected = true;
            return node;
        }));
    }, [setNodes]);

    const onRestore = useCallback(restoreFlow, [setEdges, setNodes, reactFlowInstance.setViewport]);

    useHotkeys('ctrl+a', (e) => {
        e.preventDefault();
        selectAllNode();
    })
    useHotkeys('ctrl+s', (e) => {
        e.preventDefault();
        // save all Message not saved yet
        const unsavedNodes = nodes.filter((node) => {
            console.log('node', {id: node.id, saved: node.data.isSaved});
            return node.data.isSaved === false
        });
        console.log('unsavedNodes', unsavedNodes);
    })
    useHotkeys('-', () => reactFlowInstance.zoomOut())
    useHotkeys('=', () => reactFlowInstance.zoomIn())

    const storeNodePosition = async (node) => {
        await axios.post('graph/message/node', {
            message_id: node.id,
            position_x: node.position.x,
            position_y: node.position.y,
        })
        console.log('Save Node Position');
    }

    const showConfirm = ({title, description, onConfirm, textButtonConfirm}) => {
        return new Promise((resolve, reject) => {
            confirm({
                title,
                description,
                onConfirm,
            })
        })
    }

    useEffect(() => {
        onRestore()
    }, [onRestore])

    const closeCtxMenu = () => setCtxMenuPosition(null)

    return (
        <>
            <ReactFlow
                deleteKeyCode={['Backspace', 'Delete']}
                onMoveStart={closeCtxMenu}
                onMoveEnd={onSaveViewport}
                nodes={nodes}
                edges={edges}
                nodeTypes={nodeTypes}
                edgeTypes={edgeTypes}
                onNodesChange={handleOnNodeChange}
                onEdgesChange={handleOnEdgesChange}
                defaultViewport={reactFlowInstance.getViewport()}
                onConnect={onEdgeConnect}
                onError={(code, message) => console.log('error', code, message)}
                minZoom={0.1}
                maxZoom={2}
                onResize={() => console.log('resize')}
                onNodeDragStop={(ev, node, nodes) => {
                    if (node.type === 'messageNode') {
                        storeNodePosition(node)
                    }
                }}
                onNodeDragStart={() => {
                    setCtxMenuPosition(null)
                }}
                onNodeContextMenu={(ev, node) => {
                    ev.preventDefault()
                    setCtxMenuPosition({
                        x: ev.clientX,
                        y: ev.clientY
                    })
                    setSelectedNode(node)
                    console.log('onNodeContextMenu', ev, node);
                }}
            >
                <MiniMap pannable onNodeClick={(_, node) => {
                    console.log(node);
                    reactFlowInstance.setCenter(node.position.x, node.position.y, {
                        zoom: reactFlowInstance.getZoom()
                    })
                }} />
                <Controls onZoomIn={onSaveViewport} onZoomOut={onSaveViewport} />
                <Background />
                <OverlayLoader show={showOverlayLoad} />
                <Panel position='top-left'>
                    <Button onClick={addMessageNode} size='sm' colorScheme='blue'>Add Node</Button>
                </Panel>
            </ReactFlow>
            {/* <ConfirmAlert  /> */}
            <ContextMenu position={ctxMenuPosition} onClose={closeCtxMenu}>
                <MenuItem onClick={() => console.log('New Tab')} command='⌘T'>New Tab</MenuItem>
                <MenuItem onClick={() => console.log('New Window')} command='⌘N'>New Window</MenuItem>
                <MenuItem onClick={() => console.log('Open Closed')} command='⌘⇧N'>Open Closed Tab</MenuItem>
                <MenuItem onClick={() => console.log('Open File')} command='⌘O'>Open File...</MenuItem>
            </ContextMenu>
        </>
    )
}


const OverlayLoader = ({ show = false }) => {
    if (!show) return null;
    return (
        <div className="absolute top-0 left-0 right-0 bottom-0 flex items-center flex-col z-50" onContextMenu={(e) => e.preventDefault()}>
            <div className='mt-10 text-center bold select-none bg-white bg-opacity-75 px-10 py-3 rounded'>
                <Spinner className='mx-auto block' />
            </div>
        </div>
    )
}

export default function GraphMessage({ auth, laravelVersion, phpVersion, ziggy, ...more }) {
    console.log('GraphMessage', {
        auth,
        laravelVersion,
        phpVersion,
        ziggy,
        ...more
    });
    axios.defaults.baseURL = `${ziggy.url}/api`;

    return (
        <>
            <Head title="Graph Message" />
            <AlertDialogProvider>
                <ReactFlowProvider>
                    {/* <div id="root-graph"> */}
                    <Flow ziggy={ziggy} auth={auth} {...more} />
                    {/* </div> */}
                </ReactFlowProvider>
            </AlertDialogProvider>
        </>
    );
}


// function ConfirmAlert({ onConfirm, title, description, buttonText = 'Confirm' }) {
//     const { isOpen, onOpen, onClose } = useDisclosure()
//     const cancelRef = useRef()

//     return (
//         <>
//             <Button colorScheme='red' onClick={onOpen}>
//                 Delete Customer
//             </Button>

//             <AlertDialog
//                 isOpen={isOpen}
//                 leastDestructiveRef={cancelRef}
//                 onClose={onClose}
//             >
//                 <AlertDialogOverlay>
//                     <AlertDialogContent>
//                         <AlertDialogHeader fontSize='lg' fontWeight='bold'>
//                             {title || 'Confirm Your Action'}
//                         </AlertDialogHeader>

//                         <AlertDialogBody>
//                             {description || 'Are you sure? You can not undo this action afterwards.'}
//                         </AlertDialogBody>

//                         <AlertDialogFooter>
//                             <Button ref={cancelRef} onClick={() => {
//                                 onConfirm(false)
//                                 onClose()
//                             }}>
//                                 Cancel
//                             </Button>
//                             <Button colorScheme='red' onClick={() => {
//                                 onConfirm(true)
//                                 onClose()
//                             }} ml={3}>
//                                 {buttonText}
//                             </Button>
//                         </AlertDialogFooter>
//                     </AlertDialogContent>
//                 </AlertDialogOverlay>
//             </AlertDialog>
//         </>
//     )
// }
