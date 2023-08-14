import React, { useState } from 'react';
import { Card, CardActions, CardContent, Collapse } from '@mui/material';
import { CommentType } from '../../../constants/comment';
import { User } from './cardContent/user/User';
import { TextDiv } from '../../../../../common/components/text/TextDiv';
import { Nominees } from './cardContent/nominee/Nominees';
import { ReactionsBar } from './cardContent/reaction/ReactionsBar';
import { ReplyUserIcons } from './cardContent/reply/ReplyUserIcons';
import { ReplyForm } from './cardContent/reply/form/ReplyForm';
import { Replies } from './cardContent/reply/Replies';
import { ImageList } from '../image/ImageList';

type CommentCardProps = CommentType;
export const CommentCard: React.FC<CommentCardProps> = ({
  id,
  text,
  createdAt,
  user,
  replies,
  reactions,
  nominees,
  images,
}) => {
  const [openReply, setOpenReply] = useState<boolean>(true);
  const handleReplyClick = () => setOpenReply((prev) => !prev);

  return (
    <Card>
      <CardContent>
        <User {...user} />
        <TextDiv textAlign="right">{createdAt}</TextDiv>
        <TextDiv>{text}</TextDiv>
        <ImageList imageFiles={images} />
        <Nominees nominees={nominees} commentId={id} />
        <ReactionsBar reactions={reactions} />
      </CardContent>
      <CardActions>
        <ReplyUserIcons replies={replies} handleOnClick={handleReplyClick} open={openReply} />
      </CardActions>
      <Collapse in={openReply} timeout="auto">
        <CardContent>
          <ReplyForm commentId={id} />
          {replies.length && <Replies replies={replies} />}
        </CardContent>
      </Collapse>
    </Card>
  );
};
