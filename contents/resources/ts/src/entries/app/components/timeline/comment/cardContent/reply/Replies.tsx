import React from 'react';
import { Link as RouterLink } from 'react-router-dom';
import { Avatar, Divider, Link, List, ListItem, ListItemAvatar, ListItemText } from '@mui/material';
import { ReplyType } from '../../../../../constants/comment';

type RepliesProps = { replies: ReplyType[] };
const Component: React.FC<RepliesProps> = ({ replies }) => (
  <List>
    <Divider />
    {replies.map(({ user, text, replyId }) => (
      <React.Fragment key={replyId}>
        <ListItem alignItems="flex-start">
          <ListItemAvatar>
            <Avatar alt={user.name} src={user.icon_path} />
          </ListItemAvatar>
          <ListItemText
            primary={
              <Link underline="none" component={RouterLink} to={`/user/${user.id}`}>
                {user.name}
              </Link>
            }
            secondary={text}
            secondaryTypographyProps={{
              style: { whiteSpace: 'pre-line' },
            }}
          />
        </ListItem>
        <Divider />
      </React.Fragment>
    ))}
  </List>
);

export const Replies = React.memo(Component);
