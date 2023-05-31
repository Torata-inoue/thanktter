import React, { useState } from 'react';
import { Avatar, Box, Container, IconButton, Toolbar, Tooltip, Typography } from '@mui/material';
import AppBar from '@mui/material/AppBar';
import { PositionedMenu } from '../menu/PositionedMenu';

export const Header: React.FC = () => {
  const [isOpenMenu, setOpenMenu] = useState<boolean>(false);
  const [anchorEl, setAnchorEl] = useState<null | Element>(null);

  const handleMenuClose: () => void = () => setOpenMenu(false);

  const handleMenu: (event: React.MouseEvent<HTMLElement>) => void = (event) => {
    setAnchorEl(event.currentTarget);
    setOpenMenu((prevState) => !prevState);
  };

  return (
    <AppBar position="static">
      <Container maxWidth="xl">
        <Toolbar>
          <Typography variant="h6" component="div">
            Simple Header
          </Typography>
          <Box sx={{ ml: 'auto' }}>
            <Tooltip title="メニューを開く">
              <IconButton onClick={handleMenu}>
                <Avatar alt="Remy Sharp" src="/static/images/avatar/2.jpg" />
              </IconButton>
            </Tooltip>
            <PositionedMenu anchorEl={anchorEl} isMenuOpen={isOpenMenu} handleMenuClose={handleMenuClose} />
          </Box>
        </Toolbar>
      </Container>
    </AppBar>
  );
};
