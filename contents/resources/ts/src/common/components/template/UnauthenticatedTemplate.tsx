import React, { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuthenticated } from '../../states/atoms/auth';

type UnAuthenticatedTemplateProps = { children: React.ReactNode };
export const UnAuthenticatedTemplate: React.FC<UnAuthenticatedTemplateProps> = ({ children }) => {
  const authenticated = useAuthenticated();
  const navigate = useNavigate();

  useEffect(() => {
    if (authenticated) {
      navigate('/');
    }
  }, [authenticated, navigate]);

  if (authenticated) {
    return null; // Or return some kind of "Loading" indicator.
  }
  return <div>{children}</div>;
};
