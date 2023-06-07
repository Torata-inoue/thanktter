import React from 'react';
import { Container } from '@mui/material';
import { Header } from './header/Header';

type TemplateProps = { children: React.ReactNode };
export const Template: React.FC<TemplateProps> = ({ children }) => (
  <>
    <Header />
    <Container>{children}</Container>
  </>
);
