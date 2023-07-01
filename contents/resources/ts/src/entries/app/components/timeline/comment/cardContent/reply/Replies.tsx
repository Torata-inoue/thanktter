import React from 'react';
import { Link as RouterLink } from 'react-router-dom';
import { Avatar, Divider, Link, List, ListItem, ListItemAvatar, ListItemText } from '@mui/material';
import { ReplyType } from '../../../../../constants/comment';

type RepliesProps = { replies: ReplyType[] };
export const Replies: React.FC<RepliesProps> = ({ replies }) => (
  <List>
    <Divider />
    {replies.map(({ user, text, replyId }) => (
      <>
        <ListItem key={replyId} alignItems="flex-start">
          <ListItemAvatar>
            <Avatar alt={user.name} src={user.icon} />
          </ListItemAvatar>
          <ListItemText
            primary={
              <Link underline="none" component={RouterLink} to={`/user/${user.id}`}>
                {user.name}
              </Link>
            }
            secondary={text}
          />
        </ListItem>
        <Divider />
      </>
    ))}
  </List>
);
