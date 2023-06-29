import React from 'react';
import { ReplyType } from '../../../../../constants/comment';

type RepliesProps = { replies: ReplyType[] };
export const Replies: React.FC<RepliesProps> = ({ replies }) => {
  return <div>reply</div>;
};
