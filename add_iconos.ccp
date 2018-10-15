<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" name="iconos" connection="Datos" dataSource="iconos" pageSizeLimit="100" wizardCaption="Lista de Iconos " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="True" wizardAltRecord="True" wizardRecordSeparator="False" PathID="iconos">
			<Components>
				<Label id="4" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="iconos_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="5"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="6" visible="True" name="Sorter_nom_icono" column="nom_icono" wizardCaption="Nom Icono" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_icono" PathID="iconosSorter_nom_icono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="7" visible="True" name="Sorter_path_icono" column="path_icono" wizardCaption="Path Icono" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="path_icono" PathID="iconosSorter_path_icono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="8" fieldSourceType="DBColumn" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="Detail" wizardCaption="Detail" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" dataType="Text" wizardDefaultValue="Editar" hrefSource="add_iconos.ccp" visible="Yes" PathID="iconosDetail">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="9" sourceType="DataField" name="icono_id" source="icono_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="10" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_icono" fieldSource="nom_icono" wizardCaption="Nom Icono" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="path_icono" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="32"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="34" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="path" wizardTheme="Inline" wizardThemeType="File" fieldSource="path_icono" PathID="iconospath">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="12" fieldSourceType="DBColumn" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="Alt_Detail" wizardCaption="Detail" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="60" wizardIsPassword="False" wizardUseTemplateBlock="False" dataType="Text" wizardDefaultValue="Editar" hrefSource="add_iconos.ccp" visible="Yes" PathID="iconosAlt_Detail">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="13" sourceType="DataField" name="icono_id" source="icono_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_icono" fieldSource="nom_icono" wizardCaption="Nom Icono" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="31" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="Alt_path_icono" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="33"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="35" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="alt_path" wizardTheme="Inline" wizardThemeType="File" fieldSource="path_icono" PathID="iconosalt_path">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Navigator id="16" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="iconosNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Link id="3" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="iconos_Insert" hrefSource="add_iconos.ccp" removeParameters="icono_id" wizardTheme="Inline" wizardThemeType="File" wizardThemeItem="NavigatorLink" wizardDefaultValue="Agregar Nuevo" wizardUseTemplateBlock="False" visible="Yes" PathID="iconosiconos_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<Record id="17" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" name="iconos1" dataSource="iconos" errorSummator="Error" wizardCaption="Agregar/Editar Iconos " wizardTheme="Inline" wizardThemeType="File" wizardFormMethod="post" returnPage="add_iconos.ccp" PathID="iconos1">
			<Components>
				<Hidden id="24" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="icono_id" fieldSource="icono_id" required="False" caption="Id" wizardCaption="Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="iconos1icono_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="25" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_icono" fieldSource="nom_icono" required="True" caption="Nombre descriptivo" wizardCaption="Nom Icono" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="iconos1nom_icono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<FileUpload id="27" fieldSourceType="DBColumn" allowedFileMasks="*.gif" fileSizeLimit="100000" dataType="Text" tempFileFolder="TEMP" name="FileUpload_path_icono" wizardTheme="Inline" wizardThemeType="File" fieldSource="path_icono" required="True" processedFileFolder="images" disallowedFileMasks="*.exe;*.zip;*.php;*.htm;*.html" PathID="iconos1FileUpload_path_icono">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</FileUpload>
				<Button id="18" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Agregar" PathID="iconos1Button_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="19" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Grabar" PathID="iconos1Button_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="20" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Borrar" PathID="iconos1Button_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="21" message="Borrar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="22" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Cancelar" returnPage="menu_principal.ccp" PathID="iconos1Button_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="23" conditionType="Parameter" useIsNull="False" field="icono_id" parameterSource="icono_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="add_iconos_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="add_iconos.php" comment="//" codePage="utf-8" forShow="True" url="add_iconos.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="36" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="37"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
