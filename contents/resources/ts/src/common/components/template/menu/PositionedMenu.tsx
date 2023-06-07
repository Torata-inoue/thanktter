import React from 'react';
import Menu from '@mui/material/Menu';
import { Links } from './Links';

type PositionedMenuProps = {
  anchorEl: Element | null;
  handleMenuClose: () => void;
};
export const PositionedMenu: React.FC<PositionedMenuProps> = ({ anchorEl, handleMenuClose }) => (
  <Menu
    anchorEl={anchorEl}
    anchorOrigin={{
      vertical: 'bottom',
      horizontal: 'right',
    }}
    keepMounted
    transformOrigin={{
      vertical: 'top',
      horizontal: 'right',
    }}
    open={Boolean(anchorEl)}
    onClose={handleMenuClose}
  >
    <Links handleMenuClose={handleMenuClose} />
  </Menu>
);
