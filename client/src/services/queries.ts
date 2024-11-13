import { useQuery } from "@tanstack/react-query";
import { getMsg } from "./api";

export function useMsg() {
  return useQuery({
    queryKey: ["msg"],
    queryFn: getMsg,
  });
}
