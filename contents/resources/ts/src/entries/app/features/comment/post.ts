import { api } from '../../../../common/utils/api';
import { CommentFormType } from '../../hooks/form/useCommentForm';

type PostCommentApiType = (data: CommentFormType) => Promise<any>;
export const postCommentApi: PostCommentApiType = (data) =>
  api('/comment', 'POST', {
    data,
  });
