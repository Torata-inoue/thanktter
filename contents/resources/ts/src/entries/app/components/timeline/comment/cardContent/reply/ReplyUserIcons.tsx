import React from 'react';
import { Avatar, AvatarGroup, IconButton } from '@mui/material';
import { Chat } from '@mui/icons-material';
import { ReplyType } from '../../../../../constants/comment';
import { TextDiv } from '../../../../../../../common/components/text/TextDiv';

type ReplyUserIconsProps = { replies: ReplyType[]; handleOnClick: () => void; open: boolean };
export const ReplyUserIcons: React.FC<ReplyUserIconsProps> = ({ replies, handleOnClick, open }) => (
  <IconButton onClick={handleOnClick}>
    <Chat color="disabled" />
    <AvatarGroup max={5}>
      {replies.map(({ user: { icon_path, name, id } }, index) => (
        // eslint-disable-next-line react/no-array-index-key
        <Avatar key={`${id}-${index}`} alt={name} src={icon_path} sx={{ width: 28, height: 28 }} />
      ))}
    </AvatarGroup>
    <TextDiv>{open ? '閉じる' : '返信をみる'}</TextDiv>
  </IconButton>
);
