import React from 'react';
import Menu from '@mui/material/Menu';
import { Links } from './Links';

type PositionedMenuProps = {
  anchorEl: Element | null;
  isMenuOpen: boolean;
  handleMenuClose: () => void;
};
export const PositionedMenu: React.FC<PositionedMenuProps> = ({ anchorEl, isMenuOpen, handleMenuClose }) => (
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
    open={isMenuOpen}
    onClose={handleMenuClose}
  >
    <Links handleMenuClose={handleMenuClose} />
  </Menu>
);
