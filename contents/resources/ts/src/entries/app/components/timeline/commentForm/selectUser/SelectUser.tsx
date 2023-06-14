import React, { Suspense, useMemo } from 'react';
import { TextField } from '@mui/material';
import { Loadable } from '../../../../../../common/utils/loadable';
import { getUserListApi, UserType } from '../../../../features/user/get';
import { Autocomplete } from './Autocomplete';

const Fallback: React.FC = () => <TextField variant="outlined" placeholder="推薦ユーザーを選択" disabled fullWidth />;

export const SelectUser: React.FC = () => {
  const loadable = useMemo(() => new Loadable<UserType[]>(getUserListApi()), []);

  return (
    <Suspense fallback={<Fallback />}>
      <Autocomplete loadable={loadable} />
    </Suspense>
  );
};
