import { useForm } from "react-hook-form";
import Error from "../../components/ui/error";
import { Input } from "../../components/ui/input";
import { Label } from "../../components/ui/label";
import { Patient, patientSchema } from "../../schemas/patient-interfaces";
import { zodResolver } from "@hookform/resolvers/zod";
import {
  Select,
  SelectTrigger,
  SelectValue,
  SelectContent,
  SelectItem,
} from "../../components/ui/select";
import useMultiFormStore from "../../store/multiform-store";
import {
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "../../components/ui/card";
import { Button } from "../../components/ui/button";
import { useRegisterPatient } from "../../services/patient-service";

function PatientRegistration() {
  const { mutate } = useRegisterPatient();
  const { setData } = useMultiFormStore();
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<Patient>({
    resolver: zodResolver(patientSchema),
  });

  const setFile = (e: React.ChangeEvent<HTMLInputElement>) => {};

  return (
    <main>
      <form
        onSubmit={handleSubmit((data) => mutate(data))}
        className="grid w-4/6"
      >
        <CardHeader className="grid">
          <CardTitle>Patient Registration Form</CardTitle>
        </CardHeader>
        <CardContent className="grid gap-4">
          <CardDescription>
            Please fill out all required fields.
          </CardDescription>
          <div className="grid grid-cols-3 gap-4">
            <div>
              <Label>First Name</Label>
              <Input type="text" {...register("firstName")} />
              {errors.firstName && <Error>{errors.firstName?.message}</Error>}
            </div>
            <div>
              <Label>Middle Name</Label>
              <Input type="text" {...register("middleName")} />
              {errors.middleName && <Error>{errors.middleName?.message}</Error>}
            </div>
            <div>
              <Label>Last Name</Label>
              <Input type="text" {...register("lastName")} />
              {errors.lastName && <Error>{errors.lastName?.message}</Error>}
            </div>
            <div>
              <Label>Email Address</Label>
              <Input type="text" {...register("email")} />
              {errors.email && <Error>{errors.email?.message}</Error>}
            </div>
            <div>
              <Label>Address</Label>
              <Input type="text" {...register("address")} />
              {errors.address && <Error>{errors.address?.message}</Error>}
            </div>
            <div>
              <Label>Date of Birth</Label>
              <Input type="date" {...register("birthDate")} className="w-36" />
              {errors.birthDate && <Error>{errors.birthDate?.message}</Error>}
            </div>
            <div>
              <Label>Phone Number</Label>
              <Input type="number" {...register("phoneNumber")} />
              {errors.phoneNumber && (
                <Error>{errors.phoneNumber?.message}</Error>
              )}
            </div>
            <div>
              <Label>Emergency Contact</Label>
              <Input type="number" {...register("emergencyContact")} />
              {errors.emergencyContact && (
                <Error>{errors.emergencyContact?.message}</Error>
              )}
            </div>
            <div className="grid">
              <Label>Gender</Label>
              <Select
                onValueChange={(value: "male" | "female" | "other") =>
                  setData({ gender: value })
                }
              >
                <SelectTrigger className="w-36">
                  <SelectValue placeholder="Gender" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="male">Male</SelectItem>
                  <SelectItem value="female">Female</SelectItem>
                  <SelectItem value="other">Other</SelectItem>
                </SelectContent>
              </Select>
              {errors.gender && <Error>{errors.gender?.message}</Error>}
            </div>
          </div>

          <CardDescription>Insurance Form Section</CardDescription>
          <div>
            <Label>Insurance Provider</Label>
            <Input type="text" {...register("insuranceProvider")} />
            {errors.insuranceProvider && (
              <Error>{errors.insuranceProvider?.message}</Error>
            )}
          </div>

          <div>
            <Label>Policy Number</Label>
            <Input type="number" {...register("policyNumber")} />
            {errors.policyNumber && (
              <Error>{errors.policyNumber?.message}</Error>
            )}
          </div>
        </CardContent>
        <CardFooter className="flex gap-4">
          <Button>Register</Button>
          <Button variant={"secondary"}>Cancel</Button>
        </CardFooter>
      </form>
    </main>
  );
}

export default PatientRegistration;
