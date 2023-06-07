import React from 'react';
import { Card, CardContent, TextField } from '@mui/material';
import { SelectUser } from './SelectUser/SelectUser';

export const CommentForm: React.FC = () => {
  return (
    <Card>
      <CardContent>
        <SelectUser />
        <TextField fullWidth multiline rows={4} placeholder="コメントを入力" />
      </CardContent>
    </Card>
  );
};
