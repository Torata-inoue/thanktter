import React, { Suspense, useMemo } from 'react';
import { Card, CardContent, Popover } from '@mui/material';
import { Loadable } from '../../../../../../common/utils/loadable';
import { getUserListApi, UserType } from '../../../../../../common/features/user/get';
import { UserList } from './UserList';

type ListPopoverProps = {
  anchorEl: HTMLInputElement | null;
  onCloseHandler: () => void;
};
export const ListPopover: React.FC<ListPopoverProps> = ({ anchorEl, onCloseHandler }) => {
  const loadable = useMemo(() => new Loadable<UserType[]>(getUserListApi()), []);
  return (
    <Popover
      anchorEl={anchorEl}
      open={Boolean(anchorEl)}
      onClose={onCloseHandler}
      anchorOrigin={{
        vertical: 'bottom',
        horizontal: 'center',
      }}
      transformOrigin={{
        vertical: 'top',
        horizontal: 'center',
      }}
    >
      <Card>
        <CardContent>
          <Suspense>
            <UserList loadable={loadable} />
          </Suspense>
        </CardContent>
      </Card>
    </Popover>
  );
};
