import React, { MouseEventHandler, useState } from 'react';
import { TextField } from '@mui/material';
import { ListPopover } from './ListPopover';

export const SelectUser: React.FC = () => {
  const [anchorEl, setAnchorEl] = useState<HTMLInputElement | null>(null);

  const onClickHandler: MouseEventHandler<HTMLInputElement> = (event) => {
    setAnchorEl(event.currentTarget);
  };

  const onCloseHandler: () => void = () => {
    setAnchorEl(null);
  };

  return (
    <>
      <TextField variant="outlined" onClick={onClickHandler} placeholder="推薦ユーザーを選択" />
      <ListPopover anchorEl={anchorEl} onCloseHandler={onCloseHandler} />
    </>
  );
};
