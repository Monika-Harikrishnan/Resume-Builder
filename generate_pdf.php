<?php
session_start();
require_once('tcpdf/tcpdf.php'); // Include TCPDF library
include_once 'connection.php'; // Database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to download the resume.");
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    die("Resume not found.");
}

// Fetch education, addresses, projects, certificates, and experiences
$education_stmt = $conn->prepare("SELECT specialization, institution, year_of_passing, edu_percentage FROM educations WHERE user_id = ?");
$education_stmt->bind_param("i", $user_id);
$education_stmt->execute();
$education = $education_stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$address_stmt = $conn->prepare("SELECT address1, address2, city, address_state, country, pincode FROM addresses WHERE user_id = ?");
$address_stmt->bind_param("i", $user_id);
$address_stmt->execute();
$addresses = $address_stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$project_stmt = $conn->prepare("SELECT project_name, project_description, project_duration, project_contribution FROM project_details WHERE user_id = ?");
$project_stmt->bind_param("i", $user_id);
$project_stmt->execute();
$projects = $project_stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$certificate_stmt = $conn->prepare("SELECT certificate_name, certificate_institution, duration_from, duration_to FROM certificate_details WHERE user_id = ?");
$certificate_stmt->bind_param("i", $user_id);
$certificate_stmt->execute();
$certificates = $certificate_stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$experience_stmt = $conn->prepare("SELECT company_name, role, duration_from, duration_to FROM experiences WHERE user_id = ?");
$experience_stmt->bind_param("i", $user_id);
$experience_stmt->execute();
$experiences = $experience_stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Initialize PDF document
$pdf = new TCPDF();
$pdf->AddPage();

// Set title and author
$pdf->SetTitle('Resume - ' . $user['first_name'] . ' ' . $user['last_name']);
$pdf->SetAuthor($user['first_name'] . ' ' . $user['last_name']);

// Set font and add content
$pdf->SetFont('helvetica', '', 12);

// Add user details section
$pdf->Write(0, 'Resume', '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(5);
$pdf->Write(0, 'Name: ' . $user['first_name'] . ' ' . $user['last_name'], '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, 'Email: ' . $user['email'], '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, 'Phone: ' . $user['phone_num'], '', 0, 'L', true, 0, false, false, 0);
$pdf->Ln(5);

// Add address section
$pdf->Write(0, 'Addresses:', '', 0, 'L', true, 0, false, false, 0);
foreach ($addresses as $address) {
    $pdf->Write(0, 'Address: ' . $address['address1'] . ', ' . $address['address2'] . ', ' . $address['city'] . ', ' . $address['address_state'] . ', ' . $address['country'] . ' - ' . $address['pincode'], '', 0, 'L', true, 0, false, false, 0);
}
$pdf->Ln(5);

// Add education section
$pdf->Write(0, 'Education:', '', 0, 'L', true, 0, false, false, 0);
foreach ($education as $edu) {
    $pdf->Write(0, $edu['specialization'] . ' - ' . $edu['institution'] . ' | Percentage: ' . $edu['edu_percentage'] . '% | Year of Passing: ' . $edu['year_of_passing'], '', 0, 'L', true, 0, false, false, 0);
}
$pdf->Ln(5);

// Add projects section
$pdf->Write(0, 'Projects:', '', 0, 'L', true, 0, false, false, 0);
foreach ($projects as $project) {
    $pdf->Write(0, 'Project: ' . $project['project_name'] . ' | Contribution: ' . $project['project_contribution'] . ' | Duration: ' . $project['project_duration'], '', 0, 'L', true, 0, false, false, 0);
    $pdf->Write(0, 'Description: ' . $project['project_description'], '', 0, 'L', true, 0, false, false, 0);
}
$pdf->Ln(5);

// Add certificates section
$pdf->Write(0, 'Certificates:', '', 0, 'L', true, 0, false, false, 0);
foreach ($certificates as $certificate) {
    $pdf->Write(0, 'Certificate: ' . $certificate['certificate_name'] . ' | Institution: ' . $certificate['certificate_institution'] . ' | Duration: ' . $certificate['duration_from'] . ' - ' . $certificate['duration_to'], '', 0, 'L', true, 0, false, false, 0);
}
$pdf->Ln(5);

// Add experience section
$pdf->Write(0, 'Experiences:', '', 0, 'L', true, 0, false, false, 0);
foreach ($experiences as $exp) {
    $pdf->Write(0, 'Company: ' . $exp['company_name'] . ' | Role: ' . $exp['role'] . ' | Duration: ' . $exp['duration_from'] . ' - ' . $exp['duration_to'], '', 0, 'L', true, 0, false, false, 0);
}
$pdf->Ln(5);

// Output PDF
$pdf->Output('resume.pdf', 'D'); // 'D' forces download

?>