import React from 'react';
import { Card, CardContent } from '@mui/material';
import { CommentType } from '../../../constants/comment';
import { User } from './cardContent/User';

type CommentCardProps = CommentType;
export const CommentCard: React.FC<CommentCardProps> = ({
  id,
  text,
  createdAt,
  user,
  replies,
  reactions,
  nominees,
}) => (
  <Card>
    <CardContent>
      <User {...user} />
    </CardContent>
  </Card>
);
