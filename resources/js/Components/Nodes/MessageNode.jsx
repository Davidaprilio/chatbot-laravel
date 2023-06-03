import { useCallback, useEffect, useState, useMemo } from 'react';
import { Handle, NodeToolbar, Position, getConnectedEdges, useNodeId, useStore } from 'reactflow';
import './messageNode.css';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faEnvelope, faSave } from '@fortawesome/free-regular-svg-icons';
import { Button, Card, Input, Stack, Text, Textarea, useToast } from '@chakra-ui/react';
import useDialog from '../AlertDialogProvider';
import axios from 'axios';

const handleStyle = { left: 10 };

function MessageNode({ data, id, isConnectable }) {

  const [messageData, setMessageData] = useState(data.message || {})
  const onChange = useCallback((evt) => {
    if (messageData[evt.target.name] === undefined) return console.error('Invalid key name');
    setMessageData((prev) => ({
      ...prev,
      [evt.target.name]: evt.target.value
    }))
    setIsSaved(false)
  }, []);
  const [isSaved, setIsSaved] = useState(true)

  const dialog = useDialog()
  const toast = useToast()

  const cancelMessageChanges = async () => {
    const confirm = await dialog.confirm({
      title: 'Cancel Edit Message',
      message: 'Are you sure you want to cancel editing this message?'
    })
    if (!confirm) return
    setMessageData(data.message)
    setIsSaved(true)
  }

  const saveMessageChanges = async () => {
    try {
      await axios.post(`/graph/${messageData.flow_chat_id}/message`, { id, ...messageData })
    } catch (error) {
      setIsSaved(false)
      return toast({
        title: 'Opps! Something went wrong.',
        description: error.response?.data?.message || 'Please try again later.',
        status: 'error',
        duration: 5000,
        isClosable: true,
      })
    }
    setIsSaved(true)
    toast({
      title: 'Message Updated',
      description: 'Message has been updated successfully.',
      status: 'success',
      duration: 2000,
      isClosable: true,
    })
  }


  return (
    <Card variant='outline' className='text-updater-node overflow-hidden w-80 cursor-auto'>
      <Handle
        className='react-flow__handle-lg'
        type="target"
        id="msg_box"
        position={Position.Top}
        isConnectable={isConnectable}
      />
      <div className="bg-neutral-100 border-b py-1 px-2 d-flex align-items-center justify-content-between custom-drag-handle cursor-grab active:cursor-grabbing">
        <div className='flex justify-between items-center'>
          <div>
            <FontAwesomeIcon className='me-1' icon={faEnvelope} />
            <small className="m-0 text-uppercase font-monospace fs-7">Message{messageData.hook && `: ${messageData.hook}`}</small>
          </div>
          <div>
            {!isSaved && (
              <>
                <Button size='xs' className="m-0 text-uppercase font-monospace fs-7" onClick={saveMessageChanges}>Save</Button>
                <Button size='xs' className="m-0 text-uppercase font-monospace fs-7" onClick={cancelMessageChanges}>Cancel</Button>
              </>
            )}
          </div>
        </div>

        <div>
          <small className="m-0 text-uppercase font-monospace fs-7">ID: {id}</small>
        </div>
      </div>

      {/* <NodeToolbar isVisible={data.toolbarVisible} position={data.toolbarPosition}>
        <button>delete</button>
        <button>copy</button>
        <button>expand</button>
      </NodeToolbar> */}

      <Stack spacing={3} className='px-3 pb-3'>
        <div>
          <Text fontSize='xs' color='gray.400' mt='5px' mb='-5px'>Title</Text>
          <Input
            onChange={onChange}
            placeholder='Enter Title'
            size='sm'
            name='title'
            variant='flushed'
            value={messageData.title}
          />
        </div>
        <div>
          <Text fontSize='xs' color='gray.400' mb='2px'>Text</Text>
          <Textarea
            onChange={onChange}
            className='scroll-mini'
            placeholder='Here is a sample placeholder'
            size='sm'
            name='text'
            value={messageData.text}
          />
        </div>
      </Stack>
      <NextMessageHandle
        className='react-flow__handle-lg'
        type="source"
        position={Position.Bottom}
        id="next_msg"
        onConnect={(connection) => {
          console.log('onConnect', id, connection);
        }}
        style={handleStyle}
        isConnectable={1}
      />
      <Handle
        className='react-flow__handle-lg'
        type="source"
        position={Position.Bottom}
        id="action_reply"
        isConnectable={isConnectable}
      />
    </Card>
  );
}

MessageNode.onNodeContextMenu = (ev, node) => {
  ev.preventDefault()
  console.log('onNodeContextMenu', ev, node);
}

const selector = (s) => ({
  nodeInternals: s.nodeInternals,
  edges: s.edges,
});

const NextMessageHandle = (props) => {
  const { nodeInternals, edges } = useStore(selector);
  const nodeId = useNodeId();

  const isHandleConnectable = useMemo(() => {
    const node = nodeInternals.get(nodeId);
    const nextMsgEdges = edges.filter((edge) => edge.sourceHandle === 'next_msg' && edge.source === nodeId);
    const connectedEdges = getConnectedEdges([node], nextMsgEdges);

    return connectedEdges.length < props.isConnectable;

  }, [nodeInternals, edges, nodeId, props.isConnectable]);

  return (
    <Handle {...props} isConnectable={isHandleConnectable}></Handle>
  );
};

export default MessageNode;
