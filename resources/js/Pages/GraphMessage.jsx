import ContextMenu from '@/Components/ContextMenu';
import { Button, MenuItem } from '@chakra-ui/react';
import { Head } from '@inertiajs/react';
import { useCallback, useEffect, useMemo, useState } from 'react';
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
} from "reactflow";
import "reactflow/dist/style.css";
import "../../css/graphmessage.css";
import MessageNode from '@/Components/Nodes/MessageNode';
import ButtonEdge from '@/Components/Edges/ButtonEdge';
import { useHotkeys } from "react-hotkeys-hook";
import axios from 'axios';

function Flow({ ziggy, flowChat, edges: edgesProp, nodes: nodesProp }) {
    const [nodes, setNodes, onNodesChange] = useNodesState([]);
    const [edges, setEdges, onEdgesChange] = useEdgesState([]);
    const [clipboard, setClipboard] = useState(null)
    const [selectedNode, setSelectedNode] = useState(null)
    const [ctxMenuPosition, setCtxMenuPosition] = useState(null)
    const reactFlowInstance = useReactFlow();

    const flowKey = 'example-flow';
    const nodeTypes = useMemo(() => ({ messageNode: MessageNode }), []);
    const edgeTypes = useMemo(() => ({ buttonEdge: ButtonEdge }), []);

    // set default base url axios
    axios.defaults.baseURL = `${ziggy.url}/api`;

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
            const response = await axios.post('/graph/message', {
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
        const {x = 334, y = 400, zoom = 1 } = {
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

    useEffect(() => {
        onRestore()
    }, [onRestore])

    const closeCtxMenu = () => setCtxMenuPosition(null)

    return (
        <>
            <ReactFlow
                onMoveStart={closeCtxMenu}
                onMoveEnd={onSaveViewport}
                nodes={nodes}
                edges={edges}
                nodeTypes={nodeTypes}
                edgeTypes={edgeTypes}
                onNodesChange={onNodesChange}
                onEdgesChange={onEdgesChange}
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
                onNodesDelete={(nodes) => {
                    console.log('onNodesDelete', nodes)
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
                <Panel position='top-left'>
                    <Button onClick={addMessageNode} size='sm' colorScheme='blue'>Add Node</Button>
                </Panel>
            </ReactFlow>
            <ContextMenu position={ctxMenuPosition} onClose={closeCtxMenu}>
                <MenuItem onClick={() => console.log('New Tab')} command='⌘T'>New Tab</MenuItem>
                <MenuItem onClick={() => console.log('New Window')} command='⌘N'>New Window</MenuItem>
                <MenuItem onClick={() => console.log('Open Closed')} command='⌘⇧N'>Open Closed Tab</MenuItem>
                <MenuItem onClick={() => console.log('Open File')} command='⌘O'>Open File...</MenuItem>
            </ContextMenu>
        </>
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

    return (
        <>
            <Head title="Graph Message" />
            <ReactFlowProvider>
                {/* <div id="root-graph"> */}
                <Flow ziggy={ziggy} auth={auth} {...more} />
                {/* </div> */}
            </ReactFlowProvider>
        </>
    );
}
