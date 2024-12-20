import { useMutation, useQuery } from "@tanstack/react-query";
import { AxiosError } from "axios";
import { toast } from "sonner";
import { queryClient } from "../main";
import { Patient, PatientError, Patients } from "../schemas/patient-interfaces";
import { axiosInstance, getToken } from "./api";

export function useUndoArchive() {
  const client = queryClient;

  return useMutation({
    mutationKey: ["archives"],
    mutationFn: async (patient: Patient) => {
      return (
        await axiosInstance.post(
          `/archives/undo/${patient.patientId}`,
          {},
          {
            headers: {
              Authorization: `Bearer ${getToken()}`,
            },
          }
        )
      ).data;
    },

    onSuccess: (data) => {
      client.invalidateQueries({
        queryKey: ["patients"],
      });

      client.invalidateQueries({
        queryKey: ["archives"],
      });

      toast("Patient was deleted permanently.", {
        description: `${new Date().toLocaleTimeString()}`,
        action: {
          label: "Okay",
          onClick: () => {},
        },
      });
    },

    onError: (error: AxiosError<PatientError>) => {
      toast(error.response?.data.message);
    },
  });
}

export function useDeleteArchive() {
  const client = queryClient;

  return useMutation({
    mutationKey: ["archives"],
    mutationFn: async (entityId: string | undefined) => {
      return (
        await axiosInstance.delete(`/archives/${entityId}`, {
          headers: {
            Authorization: `Bearer ${getToken()}`,
          },
        })
      ).data;
    },

    onSuccess: (data) => {
      client.invalidateQueries({
        queryKey: ["archives"],
      });

      console.log(data);

      toast("Patient was deleted permanently.", {
        description: `${new Date().toLocaleTimeString()}`,
        action: {
          label: "Okay",
          onClick: () => {},
        },
      });
    },

    onError: (error: AxiosError<PatientError>) => {
      toast(error.response?.data.message);
    },
  });
}

export function useFetchPatientArchives() {
  return useQuery<Patient[]>({
    queryKey: ["archives"],
    queryFn: async (): Promise<Patient[]> => {
      return (
        (
          await axiosInstance.post<Patients>(
            "/archives",
            {},
            {
              headers: {
                Authorization: `Bearer ${getToken()}`,
              },
            }
          )
        ).data.patients ?? []
      );
    },
    initialData: [],
  });
}

export function useFetchArchiveById(patientId: string) {
  return useQuery<Patient[]>({
    queryKey: ["archive"],
    queryFn: async (): Promise<Patient[]> => {
      return (
        (
          await axiosInstance.post<Patients>(
            `/archives/${patientId}`,
            {},
            {
              headers: {
                Authorization: `Bearer ${getToken()}`,
              },
            }
          )
        ).data.patients ?? []
      );
    },
    initialData: [],
  });
}

export function useDownloadArchives() {
  return useMutation({
    mutationKey: ["downloads"],
    mutationFn: async () => {
      return (
        await axiosInstance.post(
          "/download",
          {},
          {
            headers: {
              "Content-Type":
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            },
          }
        )
      ).data;
    },

    onSuccess: (data) => {
      console.log(data);
    },

    onError: (error) => {
      console.log(error);
    },
  });
}
