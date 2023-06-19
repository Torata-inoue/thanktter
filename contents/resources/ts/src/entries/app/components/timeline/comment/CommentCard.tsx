import React from 'react';
import { Card, CardContent } from '@mui/material';
import { CommentType } from '../../../constants/comment';

type CommentCardProps = { comment: CommentType };
export const CommentCard: React.FC<CommentCardProps> = ({
  comment: { id, text, createdAt, user, replies, reactions, nominees },
}) => (
  <Card>
    <CardContent>
      <div>{text}</div>
    </CardContent>
  </Card>
);
