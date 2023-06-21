import { Favorite, LocalFireDepartment, ThumbUpAlt } from '@mui/icons-material';
import { OverridableComponent } from '@mui/material/OverridableComponent';
import { SvgIconTypeMap } from '@mui/material';

export type ReactionNameType = 'good' | 'thanks' | 'fight';
type ReactionTypeType = 1 | 2 | 3;

type ReactionType = {
  type: ReactionTypeType;
  name: ReactionNameType;
  Component: OverridableComponent<SvgIconTypeMap> & {
    muiName: string;
  };
};
export const reactions: readonly ReactionType[] = [
  { type: 1, name: 'good', Component: ThumbUpAlt },
  { type: 2, name: 'thanks', Component: Favorite },
  { type: 3, name: 'fight', Component: LocalFireDepartment },
];

export const reactionsObject: Record<ReactionNameType, ReactionTypeType> = reactions.reduce(
  (obj, item) => ({ ...obj, [item.name]: item.type }),
  {} as Record<ReactionNameType, ReactionTypeType>
);
