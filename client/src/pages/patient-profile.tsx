import LayoutProvider from "../components/layout";
import { ProfileForm } from "../components/registration/profile-form";

function PatientProfile() {
  return (
    <LayoutProvider>
      <main className="p-8 w-4/6">
        <ProfileForm />
      </main>
    </LayoutProvider>
  );
}

export default PatientProfile;
