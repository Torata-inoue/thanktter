import React from 'react';
import { useFormContext } from 'react-hook-form';
import { Box, IconButton, SxProps, Theme, Tooltip } from '@mui/material';
import { ReactionNameType, reactions, reactionsObject } from '../../../../../constants/reactions';
import { ReactionFormType } from '../../../../../hooks/form/useReactionForm';

const iconSx: SxProps<Theme> = {
  backgroundColor: (theme) => theme.palette.primary.main,
  color: (theme) => theme.palette.background.paper,
  borderRadius: '50%',
};
const Buttons: React.FC = () => {
  const { setValue } = useFormContext<ReactionFormType>();

  const handleOnClick: (name: ReactionNameType) => React.MouseEventHandler = (name) => () => {
    setValue('type', reactionsObject[name]);
  };

  return (
    <Box>
      {reactions.map(({ Component, name }) => (
        <Tooltip key={name} title={name}>
          <IconButton type="submit" onClick={handleOnClick(name)}>
            <Component sx={iconSx} />
          </IconButton>
        </Tooltip>
      ))}
    </Box>
  );
};

type ReactionTooltipType = { children: React.ReactElement };
export const ReactionTooltip: React.FC<ReactionTooltipType> = ({ children }) => (
  <Tooltip title={<Buttons />} placement="top">
    {children}
  </Tooltip>
);
