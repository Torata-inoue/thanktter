import React from 'react';
import { HashRouter, useRoutes } from 'react-router-dom';
import { RecoilRoot } from 'recoil';
import { Login } from './pages/Login';

const Routes: React.FC = () =>
  useRoutes([
    {
      path: '/',
      element: <Login />,
    },
  ]);

export const App: React.FC = () => (
  <RecoilRoot>
    <HashRouter>
      <Routes />
    </HashRouter>
  </RecoilRoot>
);
