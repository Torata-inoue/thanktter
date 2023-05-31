import React from 'react';
import { HashRouter, useRoutes } from 'react-router-dom';
import { RecoilRoot } from 'recoil';
import { Timeline } from './pages/Timeline';
import { Exchange } from './pages/Exchange';
import { Template } from '../../common/components/template/Template';

const Routes: React.FC = () =>
  useRoutes([
    {
      path: '/',
      element: <Timeline />,
    },
    {
      path: 'exchange',
      element: <Exchange />,
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
