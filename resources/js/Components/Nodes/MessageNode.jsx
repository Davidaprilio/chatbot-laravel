import { useCallback, useState } from 'react';
import { Handle, NodeToolbar, Position } from 'reactflow';
import './messageNode.css';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faEnvelope } from '@fortawesome/free-regular-svg-icons';
// import { Dropdown } from 'react-bootstrap';
import { faEllipsisVertical } from '@fortawesome/free-solid-svg-icons';
import { Card, Input, Stack, Text, Textarea } from '@chakra-ui/react';

const handleStyle = { left: 10 };

function MessageNode({ data, isConnectable }) {

  const [messageData, setMessageData] = useState(data.message || {})
  const onChange = useCallback((evt) => {
    // console.log(evt.target.value);
  }, []);

  const [nextMsgConnected, setNextMsgConnected] = useState(false)

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
        <div>
          <FontAwesomeIcon className='me-1' icon={faEnvelope} />
          <small className="m-0 text-uppercase font-monospace fs-7">Message{messageData.hook && `: ${messageData.hook}`}</small>
        </div>

        {/* <Dropdown>
            <Dropdown.Toggle as='a' bsPrefix='text-dark cursor-pointer px-1' id="dropdown-basic" size='sm'>
              <FontAwesomeIcon icon={faEllipsisVertical} />
            </Dropdown.Toggle>

            <Dropdown.Menu className='fs-6 py-0 font-monospace'>
              <Dropdown.Item href="#/action-1">Action</Dropdown.Item>
              <Dropdown.Divider className='my-0' />
              <Dropdown.Item href="#/action-2">Another action</Dropdown.Item>
              <Dropdown.Divider className='my-0' />
              <Dropdown.Item href="#/action-3">Something else</Dropdown.Item>
            </Dropdown.Menu>
          </Dropdown> */}
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
            variant='flushed'
            value={messageData. n} 
          />
        </div>
        <div>
          <Text fontSize='xs' color='gray.400' mb='2px'>Text</Text>
          <Textarea
            onChange={onChange}
            className='scroll-mini'
            placeholder='Here is a sample placeholder'
            size='sm'
            value={messageData.text}
          />
        </div>
      </Stack>
      <Handle
        className='react-flow__handle-lg'
        type="source"
        position={Position.Bottom}
        id="next_msg"
        onConnect={(connection) => {
          setNextMsgConnected(true)
        }}
        style={handleStyle}
        isConnectable={!nextMsgConnected}
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

export default MessageNode;
