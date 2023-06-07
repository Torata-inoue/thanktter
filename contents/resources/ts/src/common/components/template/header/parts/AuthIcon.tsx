import React, { useState } from 'react';
import { Avatar, IconButton, Tooltip } from '@mui/material';
import { useAuth } from '../../../../states/atoms/auth';
import { PositionedMenu } from '../../menu/PositionedMenu';

export const AuthIcon: React.FC = () => {
  const auth = useAuth();

  const [isOpenMenu, setOpenMenu] = useState<boolean>(false);
  const [anchorEl, setAnchorEl] = useState<null | Element>(null);

  const handleMenuClose: () => void = () => setOpenMenu(false);

  const handleMenu: (event: React.MouseEvent<HTMLElement>) => void = (event) => {
    setAnchorEl(event.currentTarget);
    setOpenMenu((prevState) => !prevState);
  };

  return (
    <>
      <Tooltip title="メニューを開く">
        <IconButton onClick={handleMenu}>
          <Avatar alt={auth.name} src={auth.icon} />
        </IconButton>
      </Tooltip>
      <PositionedMenu anchorEl={anchorEl} isMenuOpen={isOpenMenu} handleMenuClose={handleMenuClose} />
    </>
  );
};
