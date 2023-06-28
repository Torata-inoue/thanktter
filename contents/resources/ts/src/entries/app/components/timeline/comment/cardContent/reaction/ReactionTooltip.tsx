import React from 'react';
import { useFormContext } from 'react-hook-form';
import { IconButton, SxProps, Theme, Tooltip } from '@mui/material';
import { ReactionNameType, reactions, reactionsObject } from '../../../../../constants/reactions';
import { ReactionFormType } from '../../../../../hooks/form/useReactionForm';
import { ReactionForm } from './ReactionForm';

const iconSx: SxProps<Theme> = {
  backgroundColor: (theme) => theme.palette.primary.main,
  color: (theme) => theme.palette.background.paper,
  borderRadius: '50%',
};
type ButtonsProps = { commentId: number };
const Buttons: React.FC<ButtonsProps> = ({ commentId }) => {
  const { setValue, getValues } = useFormContext<ReactionFormType>();
  const userId = getValues('userId');

  const handleOnClick: (name: ReactionNameType) => React.MouseEventHandler = (name) => () => {
    setValue('type', reactionsObject[name]);
  };

  return (
    <ReactionForm userId={userId} commentId={commentId}>
      {reactions.map(({ Component, name }) => (
        <IconButton key={name} type="submit" onClick={handleOnClick(name)}>
          <Component sx={iconSx} />
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
