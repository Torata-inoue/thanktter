import React, { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { Container } from '@mui/material';
import { Header } from './header/Header';
import { useAuthenticated } from '../../states/atoms/auth';

type TemplateProps = { children: React.ReactNode };
export const Template: React.FC<TemplateProps> = ({ children }) => {
  const authenticated = useAuthenticated();
  const navigate = useNavigate();

  useEffect(() => {
    if (!authenticated) {
      navigate('/login');
    }
  }, [authenticated, navigate]);

  if (!authenticated) {
    return null; // Or return some kind of "Loading" indicator.
  }

  return (
    <>
      <Header />
      <Container>{children}</Container>
    </>
  );
};
