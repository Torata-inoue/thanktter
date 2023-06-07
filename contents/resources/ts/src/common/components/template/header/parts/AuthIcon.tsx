import React, { useState } from 'react';
import { Avatar, IconButton, Tooltip } from '@mui/material';
import { useAuth } from '../../../../states/atoms/auth';
import { PositionedMenu } from '../../menu/PositionedMenu';

export const AuthIcon: React.FC = () => {
  const auth = useAuth();

  const [anchorEl, setAnchorEl] = useState<null | Element>(null);

  const handleMenu: (event: React.MouseEvent<HTMLElement>) => void = (event) => {
    setAnchorEl(event.currentTarget);
  };

  const handleMenuClose: () => void = () => {
    setAnchorEl(null);
  };

  return (
    <>
      <Tooltip title="メニューを開く">
        <IconButton onClick={handleMenu}>
          <Avatar alt={auth.name} src={auth.icon} />
        </IconButton>
      </Tooltip>
      <PositionedMenu anchorEl={anchorEl} handleMenuClose={handleMenuClose} />
    </>
  );
};
