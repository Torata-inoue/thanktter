import React from 'react';
import { HashRouter, useRoutes } from 'react-router-dom';
import { RecoilRoot } from 'recoil';
import { Timeline } from './pages/Timeline';
import { Template } from '../../common/components/template/Template';
import { Login } from './pages/Login';
import { Register } from './pages/Register';

const Routes: React.FC = () =>
  useRoutes([
    {
      path: '/',
      element: <Timeline />,
    },
    {
      path: '/login',
      element: <Login />,
    },
    {
      path: '/register',
      element: <Register />,
    },
  ]);

export const App: React.FC = () => (
  <RecoilRoot>
    <HashRouter>
      <Template>
        <Routes />
      </Template>
    </HashRouter>
  </RecoilRoot>
);
