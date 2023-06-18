import { api } from '../../../../common/utils/api';
import { CommentFormType } from '../../hooks/form/useCommentForm';
import { CommentType } from '../../constants/comment';

type PostCommentApiType = (data: CommentFormType) => Promise<CommentType[]>;
export const postCommentApi: PostCommentApiType = (data) =>
  api('/comment', 'POST', {
    data,
  });
