import React from 'react';
import { ReplyType } from '../../../../../constants/comment';

type ReplyUserIconsProps = { replies: ReplyType[]; handleOnClick: () => void };
export const ReplyUserIcons: React.FC<ReplyUserIconsProps> = ({ replies, handleOnClick }) => {
  return (
    <button type={'submit'} onClick={handleOnClick}>
      aa
    </button>
  );
};
