<?php


class Posting_address_obj {

	var $id;	
	var $postingId;
	var $addressType; //main/sub	
	var $countryId;
	var $stateId;
	var $cityId;
	var $areaId;
	var $address;
	var $landmark;
	var $pincode;	
	var $phone; //will store multiple phone numbers with comman separated
	var $fax;	
	var $contactEmail;
	var $website;	
	var $remark;		
	var $contactType; //phone, contactEmail, phoneEmail	
	var $createdDate;
	var $updatedDate;
	var $status;
	
	
	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id; }

	function setPostingId($postingId){ $this->postingId = $postingId; }
	function getPostingId(){ return $this->postingId; }
					
	function setAddressType($addressType){ $this->addressType = $addressType; }
	function getAddressType(){ return $this->addressType; }
						
	function setCountryId($countryId){ $this->countryId = $countryId; }
	function getCountryId(){ return $this->countryId;	}
	
	function setStateId($stateId){ $this->stateId = $stateId; }
	function getStateId(){ return $this->stateId;	}
	
	function setCityId($cityId){ $this->cityId = $cityId; }
	function getCityId(){ return $this->cityId;	}
	
	function setAreaId($areaId){ $this->areaId = $areaId; }
	function getAreaId(){ return $this->areaId;	}
		
	function setAddress($address){ $this->address = $address; }
	function getAddress(){ return $this->address; }
		
	function setLandmark($landmark){ $this->landmark = $landmark; }
	function getLandmark(){ return $this->landmark; }
	
	function setPincode($pincode){ $this->pincode = $pincode; }
	function getPincode(){ return $this->pincode; }
	
	function setPhone($phone){ $this->phone = $phone; }
	function getPhone(){ return $this->phone; }
		
	function setFax($fax){ $this->fax = $fax; }
	function getFax(){ return $this->fax; }
	
	function setContactEmail($contactEmail){ $this->contactEmail = $contactEmail; }
	function getContactEmail(){ return $this->contactEmail; }
	
	function setWebsite($website){ $this->website = $website; }
	function getWebsite(){ return $this->website; }

	function setRemark($remark){ $this->remark = $remark; }
	function getRemark(){ return $this->remark; }
	
	function setContactType($contactType){ $this->contactType = $contactType; }
	function getContactType(){ return $this->contactType; }
	
	function setCreatedDate($createdDate){ $this->createdDate = $createdDate; }
	function getCreatedDate(){ return $this->createdDate; }
	
	function setUpdatedDate($updatedDate){ $this->updatedDate = $updatedDate; }
	function getUpdatedDate(){ return $this->updatedDate; }
	
	function setStatus($status){ $this->status = $status; }
	function getStatus(){ return $this->status; }
		
}
/*end of file*/
		