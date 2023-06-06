import React, { Suspense } from 'react';
import { Box, Container, Toolbar, Typography } from '@mui/material';
import AppBar from '@mui/material/AppBar';
import { AuthIcon } from './parts/AuthIcon';

export const Header: React.FC = () => (
  <AppBar position="static">
    <Container maxWidth="xl">
      <Toolbar>
        <Typography variant="h6" component="div">
          Simple Header
        </Typography>
        <Box sx={{ ml: 'auto' }}>
          <Suspense>
            <AuthIcon />
          </Suspense>
        </Box>
      </Toolbar>
    </Container>
  </AppBar>
);
