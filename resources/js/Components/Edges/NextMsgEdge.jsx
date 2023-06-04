import React from 'react';
import { BaseEdge, EdgeLabelRenderer, getBezierPath } from 'reactflow';

import './buttonedge.css';
import { Badge, Stack, Text } from '@chakra-ui/react';

const onEdgeClick = (evt, id) => {
  evt.stopPropagation();
  alert(`remove ${id}`);
};

function EdgeLabel({ transform, label }) {
  return (
    <div
      style={{
        position: 'absolute',
        transform,
      }}
      className="nodrag nopan text-slate-600 bg-white py-1 text-xs px-2 rounded border-2 border-slate-500"
    >
      {label}
    </div>
  );
}

export default function NextMsgEdge({
  id,
  sourceX,
  sourceY,
  targetX,
  targetY,
  sourcePosition,
  targetPosition,
  style = {},
  markerEnd,
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
        {label && (
          <EdgeLabel
            transform={`translate(-50%, 0%) translate(${sourceX}px,${sourceY + 20}px)`}
            label={label}
          />
        )}

      </EdgeLabelRenderer>
    </>
  );
}
