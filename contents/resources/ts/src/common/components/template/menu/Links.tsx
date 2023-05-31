import React from 'react';
import { Link, MenuItem } from '@mui/material';
import { Link as RouterLink } from 'react-router-dom';
import { BorderColor, Celebration, EmojiEvents, History, Person } from '@mui/icons-material';

const pages = [
  { link: 'exchange', name: '景品交換', icon: <EmojiEvents /> },
  { link: 'mypage', name: 'マイページ', icon: <Person /> },
  { link: 'profile', name: 'プロフィール編集', icon: <BorderColor /> },
  { link: 'history', name: 'あざっす履歴', icon: <Celebration /> },
  { link: 'point/history', name: 'ポイント履歴', icon: <History /> },
];

type LinksType = { handleMenuClose: () => void };
export const Links: React.FC<LinksType> = ({ handleMenuClose }) => (
  <>
    {pages.map(({ link, name, icon }) => (
      <MenuItem key={link} onClick={handleMenuClose}>
        {icon}
        <Link sx={{ ml: 2 }} underline="none" color="inherit" component={RouterLink} to={link}>
          {name}
        </Link>
      </MenuItem>
    ))}
  </>
);
