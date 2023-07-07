import React from 'react';
import { Link, MenuItem } from '@mui/material';
import { Link as RouterLink, useNavigate } from 'react-router-dom';
import { BorderColor, Celebration, EmojiEvents, History, Logout, Person } from '@mui/icons-material';
import { postLogoutApi } from '../../../../entries/app/features/login/login';
import { handleApiError } from '../../../utils/api';
import { useSetAuth } from '../../../states/atoms/auth';

const pages = [
  { link: 'exchange', name: '景品交換', icon: <EmojiEvents /> },
  { link: 'mypage', name: 'マイページ', icon: <Person /> },
  { link: 'profile', name: 'プロフィール編集', icon: <BorderColor /> },
  { link: 'history', name: 'あざっす履歴', icon: <Celebration /> },
  { link: 'point/history', name: 'ポイント履歴', icon: <History /> },
];

type LinksType = { handleMenuClose: () => void };
export const Links: React.FC<LinksType> = ({ handleMenuClose }) => {
  const navigate = useNavigate();
  const setAuth = useSetAuth();

  const handleLogout: React.MouseEventHandler<HTMLLIElement> = () => {
    postLogoutApi()
      .then(() => {
        setAuth(null);
        navigate('/login');
      })
      .catch(handleApiError);
  };

  return (
    <>
      {pages.map(({ link, name, icon }) => (
        <MenuItem key={link} onClick={handleMenuClose}>
          {icon}
          <Link sx={{ ml: 2 }} underline="none" color="inherit" component={RouterLink} to={link}>
            {name}
          </Link>
        </MenuItem>
      ))}
      <MenuItem onClick={handleLogout}>
        <Logout />
        <Link sx={{ ml: 2 }} underline="none" color="inherit">
          ログアウト
        </Link>
      </MenuItem>
    </>
  );
};
