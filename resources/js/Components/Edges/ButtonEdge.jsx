import React from 'react';
import { BaseEdge, EdgeLabelRenderer, getBezierPath } from 'reactflow';

import './buttonedge.css';
import { Badge, Stack, Text } from '@chakra-ui/react';

const onEdgeClick = (evt, id) => {
  evt.stopPropagation();
  alert(`remove ${id}`);
};

export default function ButtonEdge({
  id,
  sourceX,
  sourceY,
  targetX,
  targetY,
  sourcePosition,
  targetPosition,
  style = {},
  markerEnd,
  data,
  label = null
}) {
  const [edgePath, labelX, labelY] = getBezierPath({
    sourceX,
    sourceY,
    sourcePosition,
    targetX,
    targetY,
    targetPosition,
  });

  return (
    <>
      <BaseEdge path={edgePath} markerEnd={markerEnd} style={style} />
      <EdgeLabelRenderer>
        <div
          style={{
            position: 'absolute',
            transform: `translate(-50%, -50%) translate(${labelX}px,${labelY}px)`,
            pointerEvents: 'all',
          }}
          className="nodrag nopan py-2 px-4 bg-white border-2 rounded d-flex"
        >
          <div className='d-flex min-w-[100px]'>
            {label && <Text className='text-sm mb-2'>{label}</Text>}
            <Stack direction='row' columnGap={0}>
              {data.textReplies.slice(0,4).map((txt, index) => (
                <>
                  <Badge colorScheme='purple' key={index} className='lowercase'>{txt}</Badge>
                  {txt === '{!*}' ? (
                    <Badge colorScheme='red' style={{ marginLeft: -1 }}>Not All</Badge>
                  ) : txt === '{*}' && (
                    <Badge colorScheme='green' style={{ marginLeft: -1 }}>All</Badge>
                  )}
                </>
              ))}
            </Stack>
          </div>
        </div>
      </EdgeLabelRenderer>
    </>
  );
}
