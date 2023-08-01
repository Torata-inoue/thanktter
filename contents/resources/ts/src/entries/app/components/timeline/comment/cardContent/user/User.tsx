import React from 'react';
import { Link as RouterLink } from 'react-router-dom';
import { Avatar, Box, Link } from '@mui/material';
import { UserType } from '../../../../../constants/user';

type UserProps = UserType;
export const User: React.FC<UserProps> = ({ id, name, icon_path }) => (
  <Box sx={{ display: 'flex', alignItems: 'center', columnGap: 2 }}>
    <Avatar src={icon_path} alt={name} />
    <Link underline="none" component={RouterLink} to={`/user/${id}`}>
      {name}
    </Link>
  </Box>
);
