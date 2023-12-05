<?php
class Transaction{
    public function addTransaction($_mysqli, $_productId, $_sellerId, $_buyerId)
    {
        $query = "CALL addTransaction(?, ?, ?);";
        try {
            $stmt = $_mysqli->prepare($query);
            $stmt->bind_param("iii", $_productId, $_sellerId, $_buyerId);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            $response = (object)array("status" => 500, "message" => $e->getMessage());
            echo json_encode($response);
            return false;
        }
        return false;
    }
    public function getSalesDetails($_mysqli, $_idSeller, $_startDate, $_endDate, $_categoryFilter)
    {
        $query = "CALL GetSalesDetails(?, ?, ?, ?);";
        try {
            $stmt = $_mysqli->prepare($query);
            $stmt->bind_param("issi", $_idSeller, $_startDate, $_endDate, $_categoryFilter);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $salesDetails = array();
            while ($row = $result->fetch_assoc()) {
                $salesDetails[] = $row;
            }
            return $salesDetails;
        } catch (Exception $e) {
            $response = (object)array("status" => 500, "message" => $e->getMessage());
            echo json_encode($response);
            return null;
        }
    }
    public function getSalesGrouped($_mysqli, $_idSeller, $_startDate, $_endDate, $_categoryFilter)
    {
        $query = "CALL GetSalesGrouped(?, ?, ?, ?);";
        try {
            $stmt = $_mysqli->prepare($query);
            $stmt->bind_param("issi", $_idSeller, $_startDate, $_endDate, $_categoryFilter);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $salesGrouped = array();
            while ($row = $result->fetch_assoc()) {
                $salesGrouped[] = $row;
            }
            return $salesGrouped;
        } catch (Exception $e) {
            $response = (object)array("status" => 500, "message" => $e->getMessage());
            echo json_encode($response);
            return null;
        }
    }
    public function getPurchasesDetails($_mysqli, $_idBuyer, $_startDate, $_endDate, $_categoryFilter)
    {
        $query = "CALL GetPurchasesDetails(?, ?, ?, ?);";
        try {
            $stmt = $_mysqli->prepare($query);
            $stmt->bind_param("issi", $_idBuyer, $_startDate, $_endDate, $_categoryFilter);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $purchasesDetails = array();
            while ($row = $result->fetch_assoc()) {
                $purchasesDetails[] = $row;
            }
            return $purchasesDetails;
        } catch (Exception $e) {
            $response = (object)array("status" => 500, "message" => $e->getMessage());
            echo json_encode($response);
            return null;
        }
    }
    public function getPurchasesGrouped($_mysqli, $_idBuyer, $_startDate, $_endDate, $_categoryFilter)
    {
        $query = "CALL GetPurchasesGrouped(?, ?, ?, ?);";
        try {
            $stmt = $_mysqli->prepare($query);
            $stmt->bind_param("issi", $_idBuyer, $_startDate, $_endDate, $_categoryFilter);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $purchasesGrouped = array();
            while ($row = $result->fetch_assoc()) {
                $purchasesGrouped[] = $row;
            }
            return $purchasesGrouped;
        } catch (Exception $e) {
            $response = (object)array("status" => 500, "message" => $e->getMessage());
            echo json_encode($response);
            return null;
        }
    }
}
?>