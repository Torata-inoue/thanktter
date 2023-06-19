import React, { Suspense } from 'react';
import { ErrorBoundary } from 'react-error-boundary';
import { Card, CardContent, Skeleton, Stack } from '@mui/material';
import { useErrorHandler } from '../../../../../common/hooks/error/userOnError';
import { useGetComments } from '../../../states/atoms/comment';
import { CommentCard } from './CommentCard';

const Loaded: React.FC = () => {
  const comments = useGetComments();
  return (
    <>
      {comments.map((comment) => (
        <CommentCard key={comment.id} comment={comment} />
      ))}
    </>
  );
};

const Fallback: React.FC = () => (
  <>
    {[...Array(20).keys()].map((value) => (
      <Card key={value}>
        <CardContent>
          <Stack spacing={1}>
            <Skeleton variant="circular" width={50} height={50} />
            <Skeleton variant="rounded" height={60} />
            <Skeleton variant="rounded" height={80} />
          </Stack>
        </CardContent>
      </Card>
    ))}
  </>
);

export const Comments: React.FC = () => {
  const onError = useErrorHandler();
  return (
    <ErrorBoundary onError={onError} FallbackComponent={Fallback}>
      <Suspense fallback={<Fallback />}>
        <Loaded />
      </Suspense>
    </ErrorBoundary>
  );
};
