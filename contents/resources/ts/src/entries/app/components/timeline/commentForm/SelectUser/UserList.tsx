import React from 'react';
import { Avatar, List, ListItemAvatar, ListItemButton, ListItemText } from '@mui/material';
import { Loadable } from '../../../../../../common/utils/loadable';
import { UserType } from '../../../../../../common/features/user/get';

type UserListProps = { loadable: Loadable<UserType[]> };
const Component: React.FC<UserListProps> = ({ loadable }) => {
  const userList = loadable.getData();

  return (
    <List
      sx={{
        width: '100%',
        bgcolor: 'background.paper',
        overflow: 'auto',
        maxHeight: 300,
        '& ul': { padding: 0 },
      }}
    >
      {userList.map(({ name, icon, id }) => (
        <ListItemButton key={id}>
          <ListItemAvatar>
            <Avatar alt={name} src={icon} />
          </ListItemAvatar>
          <ListItemText primary={name} />
        </ListItemButton>
      ))}
    </List>
  );
};

export const UserList = React.memo(Component);
