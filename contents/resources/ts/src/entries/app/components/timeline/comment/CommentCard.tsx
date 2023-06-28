import React from 'react';
import { Card, CardContent } from '@mui/material';
import { CommentType } from '../../../constants/comment';
import { User } from './cardContent/user/User';
import { TextDiv } from '../../../../../common/components/text/TextDiv';
import { Nominees } from './cardContent/nominee/Nominees';

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
      <TextDiv textAlign="right">{createdAt}</TextDiv>
      <Nominees nominees={nominees} commentId={id} />
      <TextDiv>{text}</TextDiv>
    </CardContent>
  </Card>
);
