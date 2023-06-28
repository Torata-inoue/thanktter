import { globalRecoilKeys } from '../../../common/states/globalRecoilKeys';

const localRecoilKeys = {
  APP_COMMENTS_SELECTOR: 'app.comments_selector',
  APP_COMMENTS: 'app.comments',
  APP_COMMENT_SELECTOR: 'app.comment_selector',
  APP_PAGE: 'app.page',
} as const;

export const recoilKeys = {
  ...localRecoilKeys,
  ...globalRecoilKeys,
} as const;
