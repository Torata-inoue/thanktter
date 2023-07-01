import React, { useMemo } from 'react';
import { ThumbUp } from '@mui/icons-material';
import { Box, Grid } from '@mui/material';
import { TextDiv } from '../../../../../../../common/components/text/TextDiv';
import { ReactionKeyType, reactionsObject } from '../../../../../constants/reactions';

type ProgressItemProps = { reactionKey: ReactionKeyType; value: number };
const ProgressItem: React.FC<ProgressItemProps> = ({ reactionKey, value }) => (
  <Box
    sx={{
      display: 'flex',
      flexDirection: 'column',
      justifyContent: 'center',
      overflow: 'hidden',
      color: '#fff',
      textAlign: 'center',
      whiteSpace: 'nowrap',
      transition: 'width 0.6s ease',
      width: `${value}%`,
      backgroundColor: reactionsObject[reactionKey].color,
    }}
    title={reactionKey}
  >
    {value}
  </Box>
);

type ReactionsBarProps = { reactions: { [name in ReactionKeyType]: number } };
const Component: React.FC<ReactionsBarProps> = ({ reactions }) => {
  const total = useMemo(() => Object.values(reactions).reduce((a, b) => a + b, 0), [reactions]);

  return (
    <Grid container>
      <Grid item xs={3}>
        <TextDiv>
          <ThumbUp color="disabled" />
          {total}
        </TextDiv>
      </Grid>
      <Grid item xs={9} />
      <Grid item xs={12}>
        <Box
          sx={{
            display: 'flex',
            height: '1rem',
            overflow: 'hidden',
            fontSize: '0.675rem',
            backgroundColor: '#e9ecef',
            borderRadius: '0.25rem',
          }}
        >
          {(Object.keys(reactions) as Array<ReactionKeyType>).map((key) => (
            <ProgressItem key={key} reactionKey={key} value={reactions[key]} />
          ))}
        </Box>
      </Grid>
    </Grid>
  );
};

export const ReactionsBar = React.memo(Component);
