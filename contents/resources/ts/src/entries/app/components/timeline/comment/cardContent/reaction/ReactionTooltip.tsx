import React from 'react';
import { useFormContext } from 'react-hook-form';
import { Box, IconButton, SxProps, Theme, Tooltip } from '@mui/material';
import { ReactionKeyType, reactions, reactionsObject } from '../../../../../constants/reactions';
import { ReactionFormType } from '../../../../../hooks/form/useReactionForm';
import { ReactionForm } from './ReactionForm';

const iconSx: (key: ReactionKeyType) => SxProps<Theme> = (key) => ({
  backgroundColor: reactionsObject[key].color,
  color: (theme) => theme.palette.background.paper,
  borderRadius: '50%',
});
type ButtonsProps = { commentId: number };
const Buttons: React.FC<ButtonsProps> = ({ commentId }) => {
  const { setValue, getValues } = useFormContext<ReactionFormType>();
  const userId = getValues('userId');

  const handleOnClick: (key: ReactionKeyType) => React.MouseEventHandler = (key) => () => {
    setValue('type', reactionsObject[key].type);
  };

  return (
    <ReactionForm userId={userId} commentId={commentId}>
      {reactions.map(({ Component, key }) => (
        <IconButton key={key} title={key} type="submit" onClick={handleOnClick(key)}>
          <Component sx={iconSx(key)} />
        </IconButton>
      ))}
    </ReactionForm>
  );
};

type ReactionTooltipType = { children: React.ReactElement; commentId: number };
export const ReactionTooltip: React.FC<ReactionTooltipType> = ({ children, commentId }) => (
  <Tooltip title={<Buttons commentId={commentId} />} placement="top">
    {children}
  </Tooltip>
);
