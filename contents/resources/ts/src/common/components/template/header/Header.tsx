import React, { Suspense } from 'react';
import { ErrorBoundary } from 'react-error-boundary';
import { Box, Container, Toolbar, Typography } from '@mui/material';
import AppBar from '@mui/material/AppBar';
import { AuthIcon } from './parts/AuthIcon';
import { ErrorAuthIcon } from './parts/ErrorAuthIcon';
import { useErrorHandler } from '../../../hooks/error/userOnError';

export const Header: React.FC = () => {
  const errorHandler = useErrorHandler();

  return (
    <AppBar position="static">
      <Container maxWidth="xl">
        <Toolbar>
          <Typography variant="h6" component="div">
            Simple Header
          </Typography>
          <Box sx={{ ml: 'auto' }}>
            <ErrorBoundary FallbackComponent={ErrorAuthIcon} onError={errorHandler}>
              <Suspense>
                <AuthIcon />
              </Suspense>
            </ErrorBoundary>
          </Box>
        </Toolbar>
      </Container>
    </AppBar>
  );
};
