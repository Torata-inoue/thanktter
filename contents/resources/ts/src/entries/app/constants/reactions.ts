import { Celebration, Favorite, LocalFireDepartment, ThumbUpAlt, VolunteerActivism } from '@mui/icons-material';
import { OverridableComponent } from '@mui/material/OverridableComponent';
import { SvgIconTypeMap } from '@mui/material';

export type ReactionKeyType = 'good' | 'empathy' | 'thanks' | 'congratulation' | 'fight';
type ReactionTypeType = 1 | 2 | 3 | 4 | 5;

type ReactionType = {
  type: ReactionTypeType;
  key: ReactionKeyType;
  Component: OverridableComponent<SvgIconTypeMap> & {
    muiName: string;
  };
  color: string;
};
export const reactions: readonly ReactionType[] = [
  { type: 1, key: 'good', Component: ThumbUpAlt, color: '#FFAA5A' },
  { type: 2, key: 'empathy', Component: VolunteerActivism, color: '#ff8f53' },
  { type: 3, key: 'thanks', Component: Favorite, color: '#FF734B' },
  { type: 4, key: 'congratulation', Component: Celebration, color: '#FF5844' },
  { type: 5, key: 'fight', Component: LocalFireDepartment, color: '#FF3C3C' },
];

export const reactionsObject: Record<ReactionKeyType, ReactionType> = reactions.reduce(
  (obj, item) => ({ ...obj, [item.key]: { ...item } }),
  {} as Record<ReactionKeyType, ReactionType>
);
