import { flatten, toArray } from "lodash";

export const flattenErrors = errors => flatten(toArray(errors));
