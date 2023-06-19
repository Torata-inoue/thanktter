import React from 'react';
import { CommentForm } from '../components/timeline/commentForm/CommentForm';
import { Comments } from '../components/timeline/comment/Comments';

export const Timeline: React.FC = () => (
  <>
    <CommentForm />
    <Comments />
  </>
);
