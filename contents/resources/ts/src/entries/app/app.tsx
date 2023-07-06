import React from 'react';
import { HashRouter, RouteObject, useRoutes } from 'react-router-dom';
import { RecoilRoot } from 'recoil';
import { Timeline } from './pages/Timeline';
import { Template } from '../../common/components/template/Template';
import { Login } from './pages/Login';
import { Register } from './pages/Register';
import { UnAuthenticatedTemplate } from '../../common/components/template/UnauthenticatedTemplate';

const Templates: { main: typeof Template; login: typeof UnAuthenticatedTemplate } = {
  main: Template,
  login: UnAuthenticatedTemplate,
};

type RouteType = RouteObject & { template: keyof typeof Templates };
type WrapElementWithTemplateType = (route: RouteType) => RouteObject;
const wrapElementWithTemplate: WrapElementWithTemplateType = ({ path, element, template }) => {
  const TemplateComponent = Templates[template];
  if (!TemplateComponent) {
    return { path, element };
  }

  return {
    path,
    element: <TemplateComponent>{element}</TemplateComponent>,
  };
};

const Routes: React.FC = () => {
  const routes: RouteType[] = [
    {
      path: '/',
      element: <Timeline />,
      template: 'main',
    },
    {
      path: '/login',
      element: <Login />,
      template: 'login',
    },
    {
      path: '/register',
      element: <Register />,
      template: 'login',
    },
  ];

  return useRoutes(routes.map(wrapElementWithTemplate));
};

export const App: React.FC = () => (
  <RecoilRoot>
    <HashRouter>
      <Routes />
    </HashRouter>
  </RecoilRoot>
);
