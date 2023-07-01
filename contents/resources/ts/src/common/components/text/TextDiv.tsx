import React from 'react';
import { styled } from '@mui/material';

type DivProps = {
  textAlign: 'right' | 'left' | 'center';
};
const Div = styled('div')<DivProps>(({ theme, textAlign }) => ({
  ...theme.typography.button,
  backgroundColor: theme.palette.background.paper,
  padding: theme.spacing(1),
  textAlign,
  whiteSpace: 'pre-wrap',
}));

type TextDivProps = {
  children: React.ReactNode;
  textAlign?: 'right' | 'left' | 'center';
};
export const TextDiv: React.FC<TextDivProps> = ({ children, textAlign = 'left' }) => (
  <Div textAlign={textAlign}>{children}</Div>
);
